import { useState } from "react";

const DropDown = ({ Element = null }) => {

    const [status, setStatus] = useState(false);

    return (
        <div onClick={() => setStatus(!status)}>
            <Element />
            <div className='dropdown-menu-custom'>
                hi this is menu
            </div>
        </div>
    );
}

export default DropDown;
