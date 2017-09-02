import {Component, HostListener, Inject, Input, OnInit} from '@angular/core';
import {Page} from '../../page';
import {DOCUMENT} from '@angular/common';

@Component({
  selector: 'app-page-children',
  templateUrl: './page-children.component.html',
  styleUrls: ['./page-children.component.scss']
})
export class PageChildrenComponent implements OnInit {

    @Input() page: Page = new Page;
    isScrolling = false;
    hrWidth = 0;
    childHrs = [];

    constructor(@Inject(DOCUMENT) private document: Document) { }

    @HostListener("window:scroll", [])
    onWindowScroll() {
        const pxs = [
            { start: 350, end: 1000 },
            { start: 750, end: 1500 },
            { start: 1250, end: 2000 },
            { start: 1750, end: 2500 },
            { start: 2250, end: 3000 },
        ];
        let number = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop || 0;
        if (number > 50) {
            this.isScrolling = true;
            this.hrWidth = number - 50;
        } else if (this.isScrolling && number > 500) {
            this.isScrolling = false;
            this.hrWidth = 500;
        }
        let children = this.page.children;
        for(let j = 0; j < children.length; j++) {
            this.childHrs.push(0);
        }
        for(let j = 0; j < children.length; j++) {
             this.childHrs[j] = number - pxs[j].start;
             if (number > pxs[j].end){
                this.childHrs[j] = pxs[j].end;
            }
        }
    }

    ngOnInit() {
    }

}
