import {Component, HostListener, Inject, OnInit} from '@angular/core';
import {MenuService} from '../menu/menu.service';
import {MenuItem} from '../classes/menuitem';
import {HttpErrorResponse} from '@angular/common/http';
import {Router} from '@angular/router';
import {DOCUMENT} from '@angular/common';

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.scss']
})
export class HeaderComponent implements OnInit {

    mainmenu: MenuItem[] = [];

    isScroll = false;

    overlayActive = false;

    constructor(private _ms: MenuService, private router: Router, @Inject(DOCUMENT) private document: Document ) { }

    getMainMenu(): void{
        this._ms.getMenu('primary')
            .subscribe(
                (menuitems: MenuItem[]) => {
                    console.log(menuitems);
                    this.mainmenu = menuitems;
                },
                (err: HttpErrorResponse) => err.error instanceof Error ? console.log('An Error Occured:', err.error.message) : console.log(`Backend returned code ${err.status}, body was: ${err.error}`)
            );
    }
    selectPage(pageslug): void {
        this.router.navigate([pageslug]);
        this.onActivate();
    }

    onActivate() {
        this.overlayActive = !this.overlayActive;
    }

    clickHomeLogo() {
        this.router.navigate(['/']);
        if(this.overlayActive) {
            this.overlayActive = !this.overlayActive;
        }
    }

    @HostListener("window:scroll", [])
    onWindowScroll() {
        let number = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop || 0;
        if (number > 30) {
            this.isScroll = true;
        } else if (this.isScroll && number < 10) {
            this.isScroll = false;
        }
    }

    ngOnInit() {
        this.getMainMenu();
    }

}
