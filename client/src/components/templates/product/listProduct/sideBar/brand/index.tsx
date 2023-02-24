import FormGroup from "@mui/material/FormGroup";
import IBrand from "@/interfaces/Brand";
import React, { FC, Fragment } from "react";
import ListProductdSideBarBrandItem from "./item";
import List from "@mui/material/List";

interface IListProductdSideBarBrand {
  data?: IBrand[];
}

const ListProductdSideBarBrand: FC<IListProductdSideBarBrand> = (props) => {
  const { data } = props;
  return (
    <>
      <h6 className="text-sm font-semibold mb-2.5">Brand</h6>
      <List disablePadding>
        {data?.map((item) => (
          <Fragment key={item.id}>
            <ListProductdSideBarBrandItem name={item.name} />
          </Fragment>
        ))}
      </List>
    </>
  );
};

export default ListProductdSideBarBrand;
