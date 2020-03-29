export const ListContactAction = function (dispatch, contacts) {
  dispatch({
    type: 'LIST_CONTACT',
    playload: contacts
  });
}

export const AddContactAction = function (dispatch, contact) {
  dispatch({
    type: 'ADD_CONTACT',
    playload: contact
  });
}

export const UpdateContactAction = function (dispatch, contact) {
  dispatch({
    type: 'UPDATE_CONTACT',
    playload: contact
  });
}

export const DeleteContactAction = function (dispatch, contact) {
  dispatch({
    type: 'DELETE_CONTACT',
    playload: contact
  });
}