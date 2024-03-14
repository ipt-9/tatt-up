import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class SearchService {
  private apiUrl = '/https://bbzwinf.ch:8443/phpMyAdmin/index.php?db=tatt-up'; // Replace with your PHP backend URL

  constructor(private http: HttpClient) {}

  search(term: string): Observable<any> {
    return this.http.get(`${this.apiUrl}?term=${encodeURIComponent(term)}`);
  }

}
