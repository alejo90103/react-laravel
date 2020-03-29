export const home = () => {
  return '/home';
}

// AUTH
export const login = () => {
  return '/login';
}

export const logout = () => {
  return '/logout';
}

export const register = () => {
  return '/register';
}

// CONTACT
export const showContact = () => {
  return '/showContact';
}

export const addContact = () => {
  return '/addContact';
}

export const editContact = (id = null) => {
  if (id == null) {
    return '/editContact'
  }
}