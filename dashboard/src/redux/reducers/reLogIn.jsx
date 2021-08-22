export const RelogInReducer = (state = null, action) => {
    switch (action.type) {
        case "SETRELOGINSTATUS":
            return action.payload;
        default:
            return state;
    }
};
