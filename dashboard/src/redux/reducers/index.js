import { combineReducers } from "redux";
import { tokenReducer } from "../reducers/profile";
import { ProfileReducer } from "../reducers/profile";
import { RelogInReducer } from "../reducers/reLogIn";

export const reducers = combineReducers({
    token: tokenReducer,
    profile: ProfileReducer,
    reLogIn: RelogInReducer,
});
