import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import {FormsModule, ReactiveFormsModule} from '@angular/forms';
import { HttpClientModule } from '@angular/common/http';

import { AppComponent } from './app.component';
import { PostListComponent } from './posts/post-list/post-list.component';
import { Wpng2RoutingModule } from './app-routing.module';
import { PostSingleComponent } from './posts/post-single/post-single.component';
import {NgbModule} from '@ng-bootstrap/ng-bootstrap';
import { HeaderComponent } from './header/header.component';
import { MenuComponent } from './menu/menu.component';
import {MenuService} from "app/menu/menu.service";
import { PageListComponent } from './pages/page-list/page-list.component';
import { PageSingleComponent } from './pages/page-single/page-single.component';
import {PagesService} from './pages/pages.service';
import { FooterComponent } from './footer/footer.component';
import { BodyComponent } from './body/body.component';
import { FrontpageComponent } from './frontpage/frontpage.component';
import { CallToActionComponent } from './frontpage/call-to-action/call-to-action.component';
import {ComponentMetadata} from 'codelyzer/angular/metadata';
import {CommonService} from './services/common.service';
import { AboutComponent } from './frontpage/about/about.component';
import { SpecialtiesComponent } from './frontpage/specialties/specialties.component';

@NgModule({
  declarations: [
    AppComponent,
    PostListComponent,
    PostSingleComponent,
    HeaderComponent,
    MenuComponent,
    PageListComponent,
    PageSingleComponent,
    FooterComponent,
    BodyComponent,
    FrontpageComponent,
    CallToActionComponent,
    AboutComponent,
    SpecialtiesComponent
  ],
  imports: [
      BrowserModule,
      FormsModule,
      HttpClientModule,
      Wpng2RoutingModule,
      NgbModule.forRoot(),
      ReactiveFormsModule,
  ],
  providers: [
      MenuService,
      PagesService,
      CommonService
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
