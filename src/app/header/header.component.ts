import { Component, OnInit } from '@angular/core';
import {MenuService} from '../menu/menu.service';
import {MenuItem} from '../classes/menuitem';
import {HttpErrorResponse} from '@angular/common/http';
import {Router} from '@angular/router';

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.scss']
})
export class HeaderComponent implements OnInit {

    mainmenu: MenuItem[] = [];

    overlayActive = false;

    constructor(private _ms: MenuService, private router: Router ) { }

    getMainMenu(){
        this._ms.getMainMenu()
            .subscribe(
                (menuitems: MenuItem[]) => {
                    console.log(menuitems);
                    this.mainmenu = menuitems;
                },
                (err: HttpErrorResponse) => err.error instanceof Error ? console.log('An Error Occured:', err.error.message) : console.log(`Backend returned code ${err.status}, body was: ${err.error}`)
            );
    }
    selectPage(pageslug) {
        this.router.navigate([pageslug]);
        this.onActivate();
    }

    onActivate() {
        this.overlayActive = !this.overlayActive;
    }

    ngOnInit() {
        this.getMainMenu();
    }

}
