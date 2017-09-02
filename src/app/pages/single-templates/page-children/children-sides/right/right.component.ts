import {Component, Input, OnInit} from '@angular/core';
import {Page} from '../../../../page';
import {Router} from '@angular/router';

@Component({
  selector: 'app-right',
  templateUrl: './right.component.html',
  styleUrls: ['./right.component.scss']
})
export class RightComponent implements OnInit {

    @Input() page: Page = new Page;

    constructor(private router: Router) { }

    selectPage(pageslug): void {
        this.router.navigate([pageslug]);
    }

    ngOnInit() {
    }

}
