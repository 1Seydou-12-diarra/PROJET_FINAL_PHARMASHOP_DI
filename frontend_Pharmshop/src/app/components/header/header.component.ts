import { CartService } from './../../services/cart.service';
import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.css'],
})
export class HeaderComponent implements OnInit {
  public totalItem: number = 0;
  public searchTerm !: string;
  constructor(private _cartService: CartService) {}

  ngOnInit(): void {
    this._cartService.getProducts().subscribe((response) => {
      this.totalItem = response.length;
    });
  }
  search(event:any){
    this.searchTerm = (event.target as HTMLInputElement).value;
    console.log(this.searchTerm);
    this._cartService.search.next(this.searchTerm);
  }
}
