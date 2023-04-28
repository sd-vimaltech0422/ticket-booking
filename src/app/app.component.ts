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
    this.tservice.saveBookingStatus(this.ticketJson)
      .subscribe(
        (response) => {
          this.getTicketsAvailableList();
        },
        (errors) => {
          console.log(errors);
        }
      );
  }
  /*
  toggleSeatAvailability(rowNumber: number, seatNumber: string) {
    const seat = this.coachData[0].rows[rowNumber - 1].seats.find((s: any) => s.seatNumber === seatNumber);
    seat.available = !seat.available;
  }
  */

}
