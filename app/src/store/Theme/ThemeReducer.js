const initialState = {
  type: 'light'
};

const ThemeReducer = (state = initialState, action) => {
  switch (action.type) {
    case 'LIGHT':
      return {
        ...state,
        type: 'light'
      }
    case 'DARK':
      return {
        ...state,
        type: 'dark'
      }
    default:
      return { ...state };
  }
}

export default ThemeReducer;