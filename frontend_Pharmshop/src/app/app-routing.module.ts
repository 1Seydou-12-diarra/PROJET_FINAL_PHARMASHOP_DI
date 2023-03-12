import { CartComponent } from './components/cart/cart.component';
import { ProductsComponent } from './components/products/products.component';
import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { HomeComponent } from './components/home/home.component';
import { AdminComponent } from './administrateur/admin/admin.component';
import { RegisterComponent } from './authentification/register/register.component';
import { LoginComponent } from './authentification/login/login.component';

const routes: Routes = [
  {path:'', redirectTo:'home' ,  pathMatch: 'full'},
  {path:'products', component : ProductsComponent},
  {path:'cart', component : CartComponent},
  {path:'home', component : HomeComponent},
  {path:'admin', component : AdminComponent},
  {path:'register', component :RegisterComponent  },
  {path:'login', component :LoginComponent  }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
