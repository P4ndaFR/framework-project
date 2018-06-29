import { Component, OnInit } from '@angular/core';
import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';

@Component({
  selector: 'app-trajets',
  templateUrl: './trajets.component.html',
  styleUrls: ['./trajets.component.css']
})
export class TrajetsComponent implements OnInit {
  constructor(private http: HttpClient) {
    this.httpOptions = {
      headers: new HttpHeaders({ 'Content-Type': 'application/json' })
    };
  }
  trajets: any;
  detail: any;
  url: string;
  choice: string = 'both';
  part: string = '';
  httpOptions: any;
  ngOnInit() {
    this.url=`http://prjsymf.cir3-frm-smf-ang-xx/api/`;
    this.fetchTrajets();
  }
  setChoice(choice){
    this.choice=choice;
  }
  showDetails(id) {
    this.http.get(this.url+'trajet/'+this.trajets[id].id).subscribe(res => this.trajets[id].detail = res);
  }
  searchTrajets() {
    this.http.post(this.url+'search', { "type": this.choice, "part": this.part }, this.httpOptions).subscribe(res => this.trajets = res);
    console.log(this.part);
  }
  fetchTrajets() {
    this.http.get(this.url).subscribe(res => this.trajets = res);
  }
}
