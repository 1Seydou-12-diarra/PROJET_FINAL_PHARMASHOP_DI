// import { Injectable } from '@angular/core';

// @Injectable({
//   providedIn: 'root'
// })
// export class LoginService {

//   constructor() { }
// }
import { Injectable } from '@angular/core';
import { Observable, throwError } from 'rxjs';
import { HttpClient, HttpHeaders, HttpErrorResponse } from '@angular/common/http';
import { User } from 'user';
import { catchError, map } from 'rxjs/operators';
import { Router } from '@angular/router';
const httpOptions = {
  headers: new HttpHeaders({ 'Content-Type': 'application/json'})
};



@Injectable({
  providedIn: 'root'
})
export class LoginService {
//   urrentUser = new User();

//   constructor(private http:HttpClient,public router: Router) { }
//    baseUrl: string = 'http://localhost:8000/';
  
//    getData() {
//     const headers = new HttpHeaders().set('Access-Control-Allow-Origin', '*');
//     return this.http.get('http://localhost:8000/', { headers });
//   }
  

//   login(username:string,passwords:string):Observable<any>{
//     console.log(username,passwords);
    
//     return this.http.post(this.baseUrl+'loginUser.php' ,{username,passwords},httpOptions)
//   }


   
headers = new HttpHeaders({ 'Content-Type': 'application/json' });
currentUser = new User();
constructor(private http: HttpClient, public router: Router) { }

baseUrl: string = 'http://localhost:8000/';
  
getData() {
     const headers = new HttpHeaders().set('Access-Control-Allow-Origin', '*');
      return this.http.get('http://localhost:8000/', { headers });
  }
    
//login user

login(user: User) {
  return this.http.post<any>(this.baseUrl+'loginUser.php', user).subscribe((res:any) => {
    console.log(user);
    localStorage.setItem('token', res.token);
    if (res.token){ 
     this.router.navigate(['/cart']);
    }
    else{
      this.router.navigate(['/login']);
    }
  });
}

getToken(){
  return localStorage.getItem('token');
}

get isLoggedIn(): boolean {
  let authToken = localStorage.getItem('token');
  return authToken!= null? true : false;
}
handleError(error: HttpErrorResponse) {
  let msg = '';
  if (error.error instanceof ErrorEvent) {
    // client-side error
    msg = error.error.message;
  } else {
    // server-side error
    msg = `Error Code: ${error.status}\nMessage: ${error.message}`;
  }
  return throwError(msg);
}
  

}
