export const apiClient = 'http://localhost/'
const apiDomain = 'http://localhost:8000/';

// LOGIN AND REGISTER
export const loginUrl = apiDomain + 'oauth/token';
export const userUrl = apiDomain + 'api/user';
export const registerUserUrl = apiDomain + 'api/user-register';

// CONTACT
export const contactListUrl = apiDomain + 'api/v1/contact-list'
export const getContactByIdUrl = apiDomain + 'api/v1/contact-get'
export const addContactUrl = apiDomain + 'api/v1/contact-add'
export const updateContactUrl = apiDomain + 'api/v1/contact-update'
export const deleteContactUrl = apiDomain + 'api/v1/contact-delete'