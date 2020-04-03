const initialState = {
  status: 'online'
};

const ConnectionReducer = (state = initialState, action) => {
  switch (action.type) {
    case 'ONLINE':
      return {
        ...state,
        status: 'online'
      }
    case 'OFFLINE':
      return {
        ...state,
        status: 'offline'
      }
    default:
      return { ...state };
  }
}

export default ConnectionReducer;