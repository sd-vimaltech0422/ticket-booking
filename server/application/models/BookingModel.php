<?php

class BookingModel extends CI_Model
{

  public function getAllPersonsList()
  {
    $response = array('status' => false, 'message' => '');
    /*--------------------------*/
    $this->db->select('*');
    $this->db->from('user_details');
    $result = $this->db->get()->result_array();

    if (!empty($result)) {

      $response['status'] = true;
      $response['message'] = 'Data Load Successfully';
      $response['data'] = $result;
      return $response;
    } else {

      $response['Error while getting data. Please check'];
      $response['data'] = $result;
      return $response;
    }
  }


  public function getSeatsBookingDetails($dataArray = array())
  {
    $seats = array();
    $seatsInRow = array();
    $numberOfSeats = 7;
    $response = array('status' => false, 'message' => '');
    /*--------------------------*/

    $this->db->select('s.id as seat_id, s.coach_id, s.seat_no as seatNumber, s.status as available, tb.person_id');
    $this->db->from('seats as s');
    $this->db->join('tickets_booked as tb', 'tb.seat_id = s.id', 'left');
    $result = $this->db->get()->result_array();

    if (!empty($result)) {
      $seatsInRow = array_chunk($result, $numberOfSeats);
      /*--------------------------*/
      foreach ($seatsInRow as $key => $value) {
        $seats['rows'][] = array('rowNumber' => $key + 1, 'seats' => $value);
      }
      /*--------------------------*/
      $response['status'] = true;
      $response['message'] = 'Data Load Successfully';
      $response['data'] = $seats;
      return $response;
    } else {

      $response['Error while getting data. Please check'];
      $response['data'] = $result;
      return $response;
    }
  }

  public function saveBookingData($dataObj)
  {

    $requiredSeats = $looping = $dataObj['noOfTickets'];
    $personId = $dataObj['personId'];
    /*--------------------------*/

    $response = array('status' => false, 'message' => '');
    $insertArray = array();
    $updateArray = array();
    $availableInRow = false;
    /*--------------------------*/
    $getAllSeats = $this->getSeatsBookingDetails();

    /*--------------------------*/
    foreach ($getAllSeats['data']['rows'] as $key => $value) {

      $statusCount = array_count_values(array_column($value['seats'], 'available'));

      if (array_key_exists('FALSE', $statusCount)  && $statusCount['FALSE'] >= $requiredSeats) {
        /*-IF THE PERSON IS INSIDE THIS CONDTION IT MEANS HE FOUND THE SEATS IN A ROW-*/
        $availableInRow = true;
        foreach ($value['seats'] as $skey => $svalue) {

          if ($requiredSeats != 0 && $svalue['available'] == 'FALSE') {
            /*--------------------------*/
            $insertArray[] = array(
              'person_id' => $personId,
              'coach_id' => $svalue['coach_id'],
              'seat_id' => $svalue['seat_id'],
            );

            /*--------------------------*/
            $updateArray[] = array(
              'id' => $svalue['seat_id'],
              'status' => 'TRUE',
            );
            $requiredSeats = $requiredSeats - 1;
          }
        }
      }
    }


    if ($availableInRow) {
      $this->db->insert_batch('tickets_booked', $insertArray);
      $this->db->update_batch('seats', $updateArray, 'id');
      $response['status'] = true;
      $response['message'] = "Seats Reserved For The Person ID '$personId'";
      return $response;
    } else {
      $response =  $this->findInNearByRows($getAllSeats, $dataObj);
      return $response;
    }
  }


  public function findInNearByRows($seatsAvailable, $dataObj)
  {
    $requiredSeat = $dataObj['noOfTickets'];
    $personId = $dataObj['personId'];
    /*--------------------------*/
    $smallHalf = $requiredSeat % 2 === 0 ? $requiredSeat / 2 : floor($requiredSeat / 2);
    $otherHalfSeats = $requiredSeat - $smallHalf;
    /*--------------------------*/

    foreach ($seatsAvailable['data']['rows'] as $key => $seats) {
      $currentIndex = "";
      $halfSeatsExist = false;
      $otherHalfSeatsExist = false;
      $insertArray = array();
      $updateArray = array();
      /*--------------------------*/

      $statusCount = array_count_values(array_column($seats['seats'], 'available'));
      $checkedOnCurrentIndex = $this->checkSeatsAvailability($statusCount, $smallHalf);
      /*--------------------------*/
      if ($checkedOnCurrentIndex) {
        $currentIndex = $key;
        $halfSeatsExist = true;
        $sf  = $smallHalf;
        foreach ($seats['seats'] as $key => $seat) {

          if ($sf != 0 && $seat['available'] == 'FALSE') {
            /*--------------------------*/
            $insertArray[] = array(
              'person_id' => $personId,
              'coach_id' => $seat['coach_id'],
              'seat_id' => $seat['seat_id'],
            );

            /*--------------------------*/
            $updateArray[] = array(
              'id' => $seat['seat_id'],
              'status' => 'TRUE',
            );
            $sf = $sf - 1;
          }
        }
      }

      /*--------------------------*/
      if ($halfSeatsExist && $currentIndex != "") {
        $statusForwordCount = array_count_values(array_column($seatsAvailable['data']['rows'][$currentIndex + 1]['seats'], 'available'));
        $checkedOnForwordIndex = $this->checkSeatsAvailability($statusForwordCount, $otherHalfSeats);
        if ($checkedOnForwordIndex) {
          $otherHalfSeatsExist = true;
          foreach ($seatsAvailable['data']['rows'][$currentIndex + 1]['seats'] as $key => $seat) {
            $osf = $otherHalfSeats;
            if ($osf != 0 && $seat['available'] == 'FALSE') {
              $insertArray[] = array(
                'person_id' => $personId,
                'coach_id' => $seat['coach_id'],
                'seat_id' => $seat['seat_id'],
              );
              $updateArray[] = array(
                'id' => $seat['seat_id'],
                'status' => 'TRUE',
              );
              $osf = $osf - 1;
            }
          }
          break;
        } else {
          $statusBackwordCount = array_count_values(array_column($seatsAvailable['data']['rows'][$currentIndex - 1]['seats'], 'available'));
          $checkedOnBackwordIndex = $this->checkSeatsAvailability($statusBackwordCount, $otherHalfSeats);
          if ($checkedOnBackwordIndex) {
            $otherHalfSeatsExist = true;
            foreach ($seatsAvailable['data']['rows'][$currentIndex - 1]['seats'] as $key => $seat) {
              $osf = $otherHalfSeats;
              if ($osf != 0 && $seat['available'] == 'FALSE') {
                $insertArray[] = array(
                  'person_id' => $personId,
                  'coach_id' => $seat['coach_id'],
                  'seat_id' => $seat['seat_id'],
                );
                $updateArray[] = array(
                  'id' => $seat['seat_id'],
                  'status' => 'TRUE',
                );
                $osf = $osf - 1;
              }
            }
          }
          break;
        }
      }
    }
    /*----------------*/
    if ($halfSeatsExist && $otherHalfSeats) {
      $this->db->insert_batch('tickets_booked', $insertArray);
      $this->db->update_batch('seats', $updateArray, 'id');
      $response['status'] = true;
      $response['message'] = "Seats Reserved For The Person ID '$personId'";
      return $response;
    } else {
      $response['status'] = false;
      $response['message'] = "Seats are not available in row or near by .";
      return $response;
    }
  }

  public function checkSeatsAvailability($statusArray, $requiredSeat)
  {
    $checked = false;
    if (array_key_exists('FALSE', $statusArray)  && $statusArray['FALSE'] >= $requiredSeat) {
      $checked = true;
    }
    return $checked;
  }

  public function getSeatsReservedByPerson($personId)
  {
    $this->db->select('*');
    $this->db->from('tickets_booked');
    $this->db->where('person_id', $personId);
    $result = $this->db->get()->num_rows();
    return $result;
  }
}

      /*
      echo json_encode($seats);
      exit;
      echo '<pre>';
      print_r($seatsInRow);
      exit;
      */
