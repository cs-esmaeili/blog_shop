export const setRelogIn = (status) => {
    return async (dispatch, getState) => {
        await dispatch({ type: "SETRELOGINSTATUS", payload: status });
    };
};
