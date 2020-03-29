const initialState = {
  contacts: []
};

const ContactReducer = (state = initialState, action) => {
  switch (action.type) {
    case 'LIST_CONTACT':
      return {
        ...state,
        contacts: action.playload.data
      }
    case 'ADD_CONTACT':
      return {
        ...state,
        contacts: [...state.contacts, action.playload.data]
      }
    case 'UPDATE_CONTACT':
      return {
        ...state,
        contacts: state.contacts.map(contact => {
          if (contact.id === action.playload.data.id) {
            return contact = action.playload.data;
          }
          return contact;
        })
      }
    case 'DELETE_CONTACT':
      return {
        ...state,
        contacts: state.contacts.filter(conatct => conatct.id !== action.playload.data.id)
      }
    default:
      return { ...state };
  }
}

export default ContactReducer;