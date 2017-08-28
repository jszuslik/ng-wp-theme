import { Component, OnInit } from '@angular/core';
import { PostsService } from '../posts.service';
import { ActivatedRoute, ParamMap } from '@angular/router';
import { HttpErrorResponse } from '@angular/common/http';
import { Post } from '../post';
import 'rxjs/add/operator/switchMap';

@Component({
  selector: 'app-post-single',
  templateUrl: './post-single.component.html',
  styleUrls: ['./post-single.component.css'],
  providers: [PostsService]
})
export class PostSingleComponent implements OnInit {

  post: Post;

  constructor( private postsService: PostsService, private route: ActivatedRoute ) { }

  ngOnInit() {

    this.route.paramMap
    .switchMap((params: ParamMap) =>
      this.postsService.getPost(params.get('slug')))
    .subscribe(
      (post: Post[]) => this.post = post[0],
      (err: HttpErrorResponse) => err.error instanceof Error ? console.log('An error occurred:', err.error.message) : console.log(`Backend returned code ${err.status}, body was: ${err.error}`)
    );

  }

}
