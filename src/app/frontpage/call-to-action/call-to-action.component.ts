import {AfterViewInit, Component, OnInit} from '@angular/core';
import {WOW} from 'wowjs/dist/wow.min';
import {FormControl, FormGroup} from '@angular/forms';
import {PagesService} from '../../pages/pages.service';
import {Page} from '../../pages/page';
import {CommonService} from '../../services/common.service';

@Component({
  selector: 'app-call-to-action',
  templateUrl: './call-to-action.component.html',
  styleUrls: ['./call-to-action.component.scss']
})
export class CallToActionComponent implements OnInit, AfterViewInit {

    blogDescription: string;
    homePage: Page = new Page;

    signUpForm = new FormGroup({
        'name': new FormControl(),
        'email': new FormControl(),
        'phone': new FormControl()
    });

  constructor(private _pageService: PagesService, private _cs: CommonService) { }

  getHomePage(): void {
      this._cs.getBlogDescription()
          .subscribe(
              (bd: any) => {
                  this.blogDescription = bd.description;
              }
          );
      this._pageService.getPage('home')
          .subscribe(
              (page: Page) => {
                  this.homePage = page;
              }
          );
  }

  onSubmit() {
    this._cs.createNewSignUp(this.signUpForm)
        .subscribe(
            (entryId: number) => {

            }
        );
  }

  ngOnInit() {
      this.getHomePage();
  }

  ngAfterViewInit() {
      new WOW().init();
  }

}
