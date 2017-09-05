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
    btn_text = 'Learn More';

    constructor(private router: Router) { }

    selectPage(pageslug): void {
        this.router.navigate([pageslug]);
    }

    ngOnInit() {
        if(this.page.meta_data.nrw_btn_text[0]) {
            this.btn_text = this.page.meta_data.nrw_btn_text[0];
        }
    }

}
