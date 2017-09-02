import {Component, Input, OnInit} from '@angular/core';
import {Page} from '../../page';

@Component({
  selector: 'app-page-default',
  templateUrl: './page-default.component.html',
  styleUrls: ['./page-default.component.scss']
})
export class PageDefaultComponent implements OnInit {

    @Input() page: Page = new Page;

    constructor() { }

    ngOnInit() {
    }

}
