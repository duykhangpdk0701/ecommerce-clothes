import FormGroup from "@mui/material/FormGroup";
import IBrand from "@/interfaces/Brand";
import React, { FC, Fragment } from "react";
import ListProductdSideBarColorItem from "./item";

interface IListProductdSideBarColor {
  data?: IBrand[];
}

const ListProductdSideBarColor: FC<IListProductdSideBarColor> = (props) => {
  const { data } = props;
  return (
    <>
      <h6 className="text-sm font-semibold mb-2.5">Brand</h6>
      <FormGroup>
        {data?.map((item) => (
          <Fragment key={item.id}>
            <ListProductdSideBarColorItem name={item.name} />
          </Fragment>
        ))}
      </FormGroup>
    </>
  );
};

export default ListProductdSideBarColor;
