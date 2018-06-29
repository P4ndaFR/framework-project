import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

export interface Trajets {
  backendUrl: string;
}

@Injectable()
export class TrajetsService {
  TrajetsUrl = 'assets/config.json';
  getConfig() {
    return this.http.get<Trajets>(this.TrajetsUrl);
  }
  constructor(private http: HttpClient) {
  }
}
