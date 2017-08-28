import { Wpng2Page } from './app.po';

describe('wpng2 App', function() {
  let page: Wpng2Page;

  beforeEach(() => {
    page = new Wpng2Page();
  });

  it('should display message saying app works', () => {
    page.navigateTo();
    expect(page.getParagraphText()).toEqual('app works!');
  });
});
