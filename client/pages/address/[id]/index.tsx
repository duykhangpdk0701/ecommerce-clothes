import AccountLayout from "@/layout/AccountLayout";
import {NextPageWithLayout} from "@/pages/_app";
import React, {ReactElement} from "react";
import AddressDetailTemplate from "@/components/templates/address/addressDetail";

const AddressDetail: NextPageWithLayout = () => {
    return <AddressDetailTemplate/>;
};

AddressDetail.getLayout = function getLayout(page: ReactElement) {
    return <AccountLayout>{page}</AccountLayout>;
};

export default AddressDetail;
