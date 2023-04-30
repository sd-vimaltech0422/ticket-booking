import { Component } from '@angular/core';
import { CoachData } from "../assets/data";
import { TicketService } from './services/ticket.service';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  title = 'ticket-booking';

  coachData: any = CoachData; // assign the JSON data structure to a property

  coachDataDynamic: any;
  personData: any;
  ticketJson: any = { 'personId': "", 'noOfTickets': "" };
  bookedSeats: any = [];

  constructor(private tservice: TicketService) { }

  ngOnInit(): void {
    console.log('Coach Json', this.coachData);
    /*----------------------------*/
    this.getTicketsAvailableList();
    /*----------------------------*/
    this.tservice.getPersonList()
      .subscribe(response => {
        this.personData = response.data;
      });
  }


  getTicketsAvailableList() {
    this.tservice.getTicketsAvailable()
      .subscribe(response => {
        this.coachDataDynamic = response.data;
        console.log('List Response', this.coachDataDynamic);
      });
  }

  ticketBookingSubmit() {
    this.tservice
      .saveBookingStatus(this.ticketJson)
      .subscribe(
        (response) => {
          alert(response.message);
          this.getTicketsAvailableList();
        },
        (errors) => {
          console.log(errors);
        }
      );
  }


  getSeatsByPersonId(personId: any) {
    this.bookedSeats = [];
    let array = this.coachDataDynamic['rows'];
    array.forEach((data: any, index: number) => {

      data['seats'].forEach((_data: any, index: number) => {

        if (_data.person_id == personId) {
          this.bookedSeats.push(_data.seatNumber);
          /*
          console.warn('Row Number', data.rowNumber);
          console.warn('Seats Log', _data.seatNumber);
          */
        }
      });
    });
    /*
console.log('Seats On Person Id', this.bookedSeats);
console.log('Seats On Person Id', this.bookedSeats.join(','));
*/
  }




  /*
  toggleSeatAvailability(rowNumber: number, seatNumber: string) {
    const seat = this.coachData[0].rows[rowNumber - 1].seats.find((s: any) => s.seatNumber === seatNumber);
    seat.available = !seat.available;
  }
  */

}
