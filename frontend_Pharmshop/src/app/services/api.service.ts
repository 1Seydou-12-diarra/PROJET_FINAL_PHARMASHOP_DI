import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { map } from 'rxjs';

@Injectable({
  providedIn: 'root',
})
export class ApiService {
  constructor(private _http: HttpClient) {}

  getProduct() {
    return this._http
      .get<any>('http://localhost:8000/lireProduit.php')
      .pipe(map((response: any) => {
        return response;
      }));
  }
}
