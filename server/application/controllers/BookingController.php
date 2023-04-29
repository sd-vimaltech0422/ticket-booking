<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BookingController extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    header("Access-Control-Allow-Origin:*");
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == "OPTIONS") {
      die();
    }
    /*--MODEL LOAD BELOW--*/
    $this->load->model('BookingModel', 'BObj');
  }


  public function getAllPersonsList()
  {
    $request = array('status' => false, 'message' => '');
    /*--------------------------*/

    if ($this->input->method() == 'get') {
      $result = $this->BObj->getAllPersonsList();
      echo json_encode($result);
    } else {
      $request['message'] = "Invalid Request Method";
      echo json_encode($request);
    }
  }

  public function getSeatsBookingDetails()
  {
    $request = array('status' => false, 'message' => '');
    /*--------------------------*/

    if ($this->input->method() == 'get') {

      $result = $this->BObj->getSeatsBookingDetails();
      echo json_encode($result);
    } else {

      $request['message'] = "Invalid Request Method";
      echo json_encode($request);
    }
  }

  public function saveBookingData()
  {
    $request = array('status' => false, 'message' => '');
    /*--------------------------*/
    if ($this->input->method() == 'post') {

      $dataObj = json_decode($this->input->raw_input_stream, true);
      if (
        !empty($dataObj) &&
        isset($dataObj['personId']) && $dataObj['personId'] != "" &&
        isset($dataObj['noOfTickets']) && $dataObj['noOfTickets'] != ""
      ) {

        /*--------------------------*/
        $checkAlreadyBookedSeats = $this->BObj->getSeatsReservedByPerson($dataObj['personId']);
        $checkPoint = $checkAlreadyBookedSeats > 0 ? $checkAlreadyBookedSeats + $dataObj['noOfTickets'] : 0;
        /*--------------------------*/

        if ($dataObj['noOfTickets'] <= 7 && $checkPoint <= 7) {
          $result = $this->BObj->saveBookingData($dataObj);
        } else if ($checkPoint) {
          $remaingSeats =  7 - $checkAlreadyBookedSeats;
          $request['message'] = "You have already booked some seats. Now you can only book '$remaingSeats' Seats";
          echo json_encode($request);
        } else {
          $request['message'] = "Entered the no of seats should not more than 7. Please enter the details.";
          echo json_encode($request);
        }
        /*--------------------------*/
      } else {
        $request['message'] = "Mandatory Fields Is Missing.. 'Person Id', 'No of Seats'. Please check before submit";
        echo json_encode($request);
      }

      /*--------------------------*/
    } else {
      $request['message'] = "Invalid Request Method";
      echo json_encode($request);
    }
  }
}
