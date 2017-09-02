import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { PageDefaultComponent } from './page-default.component';

describe('PageDefaultComponent', () => {
  let component: PageDefaultComponent;
  let fixture: ComponentFixture<PageDefaultComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ PageDefaultComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(PageDefaultComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should be created', () => {
    expect(component).toBeTruthy();
  });
});
