import { Component, OnInit } from '@angular/core';
import {PagesService} from '../pages.service';
import {ActivatedRoute, ParamMap} from '@angular/router';
import {Page} from '../page';
import {HttpErrorResponse} from '@angular/common/http';

@Component({
  selector: 'app-page-single',
  templateUrl: './page-single.component.html',
  styleUrls: ['./page-single.component.scss']
})
export class PageSingleComponent implements OnInit {

    page: Page;

  constructor( private _pagesService: PagesService, private route: ActivatedRoute) { }

  ngOnInit() {
      console.log(this.route.snapshot.params['pageslug']);
      this.route.paramMap
          .switchMap((params: ParamMap) =>
              this._pagesService.getPage(params.get('pageslug')))
          .subscribe(
              (page: Page) => this.page = page,
              (err: HttpErrorResponse) => err.error instanceof Error ? console.log('An error occurred:', err.error.message) : console.log(`Backend returned code ${err.status}, body was: ${err.error}`)
          );
  }

}
