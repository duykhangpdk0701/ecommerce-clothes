//mui component
import Divider from "@mui/material/Divider";
import Paper from "@mui/material/Paper";
import React, { FC, ReactNode } from "react";
import ListProductdSideBarBrand from "./brand";

interface IListProductSideBar {
  listProductSideBarItemCategory: ReactNode;
  listProductSideBarBrand: ReactNode;
  listProudctSideBarPersonType: ReactNode;
}

const ListProductSideBar: FC<IListProductSideBar> = (props) => {
  const {
    listProductSideBarItemCategory,
    listProductSideBarBrand,
    listProudctSideBarPersonType,
  } = props;
  return (
    <Paper className="w-full py-4 px-7">
      {listProductSideBarItemCategory}
      <Divider className="border-[#F3F5F9] my-6" />
      {listProductSideBarBrand}
      <Divider className="border-[#F3F5F9] my-6" />
      {listProudctSideBarPersonType}
    </Paper>
  );
};

export default ListProductSideBar;
