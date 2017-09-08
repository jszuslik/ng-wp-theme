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
import {CommonService} from './services/common.service';
import { AboutComponent } from './frontpage/about/about.component';
import { SpecialtiesComponent } from './frontpage/specialties/specialties.component';
import { ProcessComponent } from './frontpage/process/process.component';
import { FeedbackComponent } from './frontpage/feedback/feedback.component';
import { PageChildrenComponent } from './pages/single-templates/page-children/page-children.component';
import { PageDefaultComponent } from './pages/single-templates/page-default/page-default.component';
import { LeftComponent } from './pages/single-templates/page-children/children-sides/left/left.component';
import { RightComponent } from './pages/single-templates/page-children/children-sides/right/right.component';

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
    SpecialtiesComponent,
    ProcessComponent,
    FeedbackComponent,
    PageChildrenComponent,
    PageDefaultComponent,
    LeftComponent,
    RightComponent
  ],
  imports: [
      BrowserModule.withServerTransition({appId: 'ng-wp-theme'}),
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
