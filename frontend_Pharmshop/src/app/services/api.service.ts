import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core'
import { map } from 'rxjs';

@Injectable({
  providedIn: 'root',
})
export class ApiService {
  constructor(private _http: HttpClient) {}
  baseUrl: string = 'http://localhost:8000/';
  
  getData() {
    const headers = new HttpHeaders().set('Access-Control-Allow-Origin', '*');
    return this._http.get('http://localhost:8000/', { headers });
  }
  

  getProduct() {
    return this._http
      .get<any>(this.baseUrl+'produitAll.php')
      .pipe(map((response: any) => {
        return response;
      }));
  }
}

