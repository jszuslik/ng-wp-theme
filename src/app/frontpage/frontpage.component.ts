import {Component, HostListener, Inject, OnInit} from '@angular/core';
import {DOCUMENT} from '@angular/common';

@Component({
  selector: 'app-frontpage',
  templateUrl: './frontpage.component.html',
  styleUrls: ['./frontpage.component.scss']
})
export class FrontpageComponent implements OnInit {

    isScrolling = false;
    hrWidth = 0;

    constructor(@Inject(DOCUMENT) private document: Document) { }

    @HostListener("window:scroll", [])
    onWindowScroll() {
        let number = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop || 0;
        if (number > 90) {
            this.isScrolling = true;
            this.hrWidth = number - 90;
        } else if (this.isScrolling && number > 500) {
            this.isScrolling = false;
            this.hrWidth = 500;
        }
    }

    ngOnInit() {
    }

}
