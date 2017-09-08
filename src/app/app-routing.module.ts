import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { PostListComponent } from './posts/post-list/post-list.component';
import { PostSingleComponent } from './posts/post-single/post-single.component';
import {PageSingleComponent} from './pages/page-single/page-single.component';
import {FrontpageComponent} from './frontpage/frontpage.component';

const routes: Routes = [
    {
        path: '',
        component: FrontpageComponent,
        pathMatch: 'full'
    },
    {
        path: 'post/:postslug',
        component: PostSingleComponent
    },
    {
        path: ':pageslug',
        component: PageSingleComponent
    }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule],
  providers: []
})
export class Wpng2RoutingModule { }
