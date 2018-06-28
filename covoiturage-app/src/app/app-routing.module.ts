import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { TrajetsComponent } from './trajets/trajets.component';

const routes: Routes = [
{ path: '', component: TrajetsComponent}
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
