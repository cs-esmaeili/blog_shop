import { useSelector, useDispatch } from "react-redux";
import { getCookie } from "../global/cookie";
import { setToken } from "../redux/actions/profile";
import LogIn from "./pages/LogIn";
import LogInModal from "./components/LogInModal";
import Main from "./layouts/Main";

const Index = () => {
    const token = useSelector((state) => state.token);
    const dispatch = useDispatch();

    if (token === null && getCookie("token") !== null) {
        dispatch(setToken(getCookie("token")));
    }

    return (
        <div className='container-true'>
            {getCookie("token") === null ? (
                <LogIn />
            ) : (
                <>
                    <Main />
                    <LogInModal />
                </>
            )}
        </div>
    );
};

export default Index;
