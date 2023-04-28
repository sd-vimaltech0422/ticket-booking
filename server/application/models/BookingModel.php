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


  public function getSeatsBookingDetails()
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

    $seatsValue = $looping = $dataObj['noOfTickets'];
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

      if (array_key_exists('FALSE', $statusCount)  && $statusCount['FALSE'] >= $seatsValue) {
        /*-IF THE PERSON IS INSIDE THIS CONDTION IT MEANS HE FOUND THE SEATS IN A ROW-*/
        $looping = 0;
        $availableInRow = true;
        foreach ($value['seats'] as $skey => $svalue) {

          if ($seatsValue != 0) {
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
            $seatsValue = $seatsValue - 1;
          }
        }
      }
    }

    $this->db->insert_batch('tickets_booked', $insertArray);
    $this->db->update_batch('seats', $updateArray, 'id');
    if ($availableInRow) {
      $response['status'] = true;
      $response['message'] = "Seats Reserved For The Person ID '$personId'";
      return $response;
    } else {
      $this->findInNearByRows($getAllSeats, $seatsValue);
    }
  }


  public function findInNearByRows($seatsAvailable, $requiredSeats)
  {

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
