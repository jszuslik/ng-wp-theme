import {AfterViewInit, Component, OnInit} from '@angular/core';
import {WOW} from 'wowjs/dist/wow.min';
import {FormControl, FormGroup} from '@angular/forms';
import {PagesService} from '../../pages/pages.service';
import {Page} from '../../pages/page';
import {CommonService} from '../../services/common.service';
import {FormResponse} from '../../classes/form-response';

@Component({
  selector: 'app-call-to-action',
  templateUrl: './call-to-action.component.html',
  styleUrls: ['./call-to-action.component.scss']
})
export class CallToActionComponent implements OnInit, AfterViewInit {

    blogInfo: {} = {
        title: '',
        description: ''
    };
    homePage: Page = new Page;

    signUpForm = new FormGroup({
        'name': new FormControl(),
        'email': new FormControl(),
        'phone': new FormControl()
    });
    response: FormResponse;
    ctaIsFormSuccess = false;
    ctaFormSuccessMessage = 'Thank You For Your Submission';
    ctaIsFormError = false;
    ctaFormErrorMessage = 'There Has Been An Error';

    constructor(private _pageService: PagesService, private _cs: CommonService) { }

    getHomePage(): void {
        this._cs.getBlogDescription()
            .subscribe(
              (bd: any) => {
                  this.blogInfo = bd;
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
            (response: FormResponse) => {
                console.log('Help');
                    if (response.id) {
                        console.log(response.id);
                        this.ctaIsFormSuccess = true;
                        this.ctaIsFormError = false;
                        this.response = response;
                        this.signUpForm.reset();
                    } else {
                        console.log(response);
                        this.ctaIsFormSuccess = false;
                        this.ctaIsFormError = true;
                        this.response = response;
                    }
                },
                (error: any) => {
                    console.log(error);
                    this.ctaFormErrorMessage = error.message;
                },
                () => {
                    this.ctaFormSuccessMessage = 'Thank you ' + this.response.message + '! We will contact you shortly.';
                    this.ctaFormErrorMessage = this.response.message;
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
