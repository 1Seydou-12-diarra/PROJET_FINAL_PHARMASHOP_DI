import { TestBed } from '@angular/core/testing';
import {RegistrationService} from 'src/app/register.service';


describe('RegisterService', () => {
  let service: RegistrationService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(RegistrationService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
