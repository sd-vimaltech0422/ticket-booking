import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from "rxjs";
import { catchError, map } from "rxjs/operators";
import { throwError } from "rxjs";
import { URL, Booking } from 'src/app/constant/api.constant';


@Injectable({
  providedIn: 'root'
})
export class TicketService {

  private url = URL.BASE_URL;

  constructor(private http: HttpClient) { }

  getTicketsAvailable(): Observable<any> {
    return this.http.get(URL.BASE_URL + Booking.GET_SEATS_DETAILS)
      .pipe(
        map((data) => data),
        catchError((error) => throwError(error))
      );;
  }

  /*----------------------------*/

  getPersonList(): Observable<any> {
    return this.http.get(URL.BASE_URL + Booking.GET_PERSON_DETAILS)
      .pipe(
        map((data) => data),
        catchError((error) => throwError(error))
      );;
  }

  /*----------------------------*/

  saveBookingStatus(data: any): Observable<any> {
    return this.http
      .post<any>(URL.BASE_URL + Booking.SAVE_BOOKING_STATUS, data)
      .pipe(map((data) => data), catchError((error) => throwError(error)));
  }

}
