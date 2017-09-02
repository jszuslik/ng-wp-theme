import { Component, OnInit } from '@angular/core';
import {MenuService} from '../menu/menu.service';
import {MenuItem} from '../classes/menuitem';
import {HttpErrorResponse} from '@angular/common/http';
import {Router} from '@angular/router';
import {CommonService} from "app/services/common.service";

@Component({
  selector: 'app-footer',
  templateUrl: './footer.component.html',
  styleUrls: ['./footer.component.scss']
})
export class FooterComponent implements OnInit {

    footerMenu: MenuItem[] = [];
    socialMenu: MenuItem[] = [];
    serviceMenu: MenuItem[] = [];
    blogInfo: {} = {
        title: '',
        description: ''
    };

    constructor(private _ms: MenuService, private router: Router, private _cs: CommonService) { }

    getFooterMenu(): void {
        this._ms.getMenu('footer')
            .subscribe(
                (menuitems: MenuItem[]) => {
                    console.log(menuitems);
                    this.footerMenu = menuitems;
              },
              (err: HttpErrorResponse) => err.error instanceof Error ? console.log('An Error Occured:', err.error.message) : console.log(`Backend returned code ${err.status}, body was: ${err.error}`)
          );
    }

    getSocialMenu(): void {
        this._ms.getMenu('social')
            .subscribe(
                (menuitems: MenuItem[]) => {
                    console.log(menuitems);
                    this.socialMenu = menuitems;
                },
                (err: HttpErrorResponse) => err.error instanceof Error ? console.log('An Error Occured:', err.error.message) : console.log(`Backend returned code ${err.status}, body was: ${err.error}`)
            );
    }

    getServiceMenu(): void {
        this._ms.getMenu('service')
            .subscribe(
                (menuitems: MenuItem[]) => {
                    console.log(menuitems);
                    this.serviceMenu = menuitems;
                },
                (err: HttpErrorResponse) => err.error instanceof Error ? console.log('An Error Occured:', err.error.message) : console.log(`Backend returned code ${err.status}, body was: ${err.error}`)
            );
    }

    getBlogInfo(): void {
        this._cs.getBlogDescription()
            .subscribe(
                (bd: any) => {
                    this.blogInfo = bd;
                }
            );
    }

    selectPage(pageslug): void {
        this.router.navigate([pageslug]);
    }

  ngOnInit() {
        this.getFooterMenu();
        this.getSocialMenu();
        this.getServiceMenu();
        this.getBlogInfo();
  }

}
