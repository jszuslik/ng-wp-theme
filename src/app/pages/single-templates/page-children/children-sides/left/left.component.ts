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
    btn_text = 'Learn More';
    thumbnail: string;

    constructor(private router: Router) { }

    selectPage(pageslug): void {
        this.router.navigate([pageslug]);
    }

    ngOnInit() {
        if(this.page.meta_data.nrw_btn_text[0]) {
            this.btn_text = this.page.meta_data.nrw_btn_text[0];
        }
        if(this.page.post_thumbnail){
            this.thumbnail = this.page.post_thumbnail;
        }
    }

}
