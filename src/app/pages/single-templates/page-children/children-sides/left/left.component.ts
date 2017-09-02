import {Component, Input, OnInit} from '@angular/core';
import {Page} from '../../../../page';
import {Router} from '@angular/router';

@Component({
  selector: 'app-left',
  templateUrl: './left.component.html',
  styleUrls: ['./left.component.scss']
})
export class LeftComponent implements OnInit {

    @Input() page: Page = new Page;

    constructor(private router: Router) { }

    selectPage(pageslug): void {
        this.router.navigate([pageslug]);
    }

    ngOnInit() {
    }

}
