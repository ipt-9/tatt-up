import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { LayoutComponent} from "./layout/layout.component";
import { NavigationComponent} from "./navigation/navigation.component";


const routes: Routes = [
  {path: 'layout', component: LayoutComponent},
  {path: 'navigation', component: NavigationComponent}

];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
