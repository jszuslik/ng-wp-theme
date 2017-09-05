import {AfterViewInit, Component, OnInit} from '@angular/core';
import {WOW} from 'wowjs/dist/wow.min';
import {FormControl, FormGroup} from '@angular/forms';
import {PagesService} from '../../pages/pages.service';
import {Page} from '../../pages/page';
import {CommonService} from '../../services/common.service';
import {FormResponse} from '../../classes/form-response';
import {Title} from "@angular/platform-browser";

@Component({
  selector: 'app-call-to-action',
  templateUrl: './call-to-action.component.html',
  styleUrls: ['./call-to-action.component.scss']
})
export class CallToActionComponent implements OnInit, AfterViewInit {

    tabTitle: string;
    homePage: Page;

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

    constructor(private _pageService: PagesService, private _cs: CommonService, private titleService: Title) { }

    setTitle() {
        this.tabTitle = this.homePage.blog_title + ' | ' + this.homePage.blog_description;
        this.titleService.setTitle(this.tabTitle);
    }

    getHomePage(): void {
        this._pageService.getPage('home')
            .subscribe(
              (page: Page) => {
                  this.homePage = page;
              },
                (error: any) => {

                },
                () => {
                    this.setTitle();
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
