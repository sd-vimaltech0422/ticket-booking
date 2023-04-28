import { environment } from "src/environments/environment";

export class URL {
  public static BASE_URL = environment.API_BASE_URL;
}

export class Booking {
  public static GET_SEATS_DETAILS = 'getallseatsavailable';
  public static GET_PERSON_DETAILS = 'getallpersons';
  public static SAVE_BOOKING_STATUS = 'savebookingstatus';

}
