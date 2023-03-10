import { CartService } from './../../services/cart.service';
import { ApiService } from './../../services/api.service';
import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-products',
  templateUrl: './products.component.html',
  styleUrls: ['./products.component.css'],
})
export class ProductsComponent implements OnInit {
  public productList: any;
  
  public filterCategory : any
  searchKey:string ="";

  constructor(private _api: ApiService, private _cartService : CartService) {}

  ngOnInit(): void {
    this._api.getProduct().subscribe((response) => {
      this.productList = response;
      this.filterCategory = response
      this.productList.forEach((a:any)=>{
      if(a.category ==="corps" || a.category ==="cheveux"  || a.category ==="Beauté"){
          a.category ="Beauté"
        }
        Object.assign(a,{quantity:1,total:a.price});
      });
      console.log(this.productList)
    });
    this._cartService.search.subscribe((val:any)=>{
      this.searchKey = val;
    })
  }
  addtocart(item : any){
    this._cartService.addToCart(item);
  }
  filter(category:string){
    this.filterCategory = this.productList
    .filter((a:any)=>{
      if(a.category == category || category==''){
        return a;
      }
    })
  }

  
  
}
