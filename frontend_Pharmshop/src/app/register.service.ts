// import { Injectable } from '@angular/core';
// import { HttpClient } from '@angular/common/http'

// @Injectable({
//   providedIn: 'root'
// })
// export class RegisterService {

//   constructor() { }
// }
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class RegistrationService {

  constructor(private http:HttpClient) { }
  baseUrl: string = 'http://localhost:8000/';
  
  getData() {
    const headers = new HttpHeaders().set('Access-Control-Allow-Origin', '*');
    return this.http.get('http://localhost:8000/', { headers });
  }
  

  register(username:string,email:string,passwords:string):Observable<any>{
    return this.http.post(this.baseUrl+'createUser.php',{username,email,passwords})
  }
}