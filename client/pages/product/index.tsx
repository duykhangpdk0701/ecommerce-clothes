//api
import brandAPI from "@/api/brandAPI";
import categoryAPI from "@/api/categoryAPI";
import itemAPI from "@/api/itemAPI";
import personTypeAPI from "@/api/personTypeAPI";
//component
import ListProductTemplate from "@/components/templates/product/listProduct";
import ListProductProducts from "@/components/templates/product/listProduct/products";
import ListProductSideBar from "@/components/templates/product/listProduct/sideBar";
import ListProductdSideBarBrand from "@/components/templates/product/listProduct/sideBar/brand";
import ListProductSideBarItemCategory from "@/components/templates/product/listProduct/sideBar/category";
import ListProductSideBarPersonType from "@/components/templates/product/listProduct/sideBar/personType";
import ListProductSortBar from "@/components/templates/product/listProduct/sortBar";
//layout
import HomeLayout from "@/layout/HomeLayout";
//nextjs
import Head from "next/head";
import React, { ReactElement } from "react";
import { useQuery } from "react-query";

const Product = () => {
  const itemQuery = useQuery({
    queryKey: ["item"],
    queryFn: () => itemAPI.getListOfItem(),
  });

  const itemCategoryQuery = useQuery(
    "item-category",
    categoryAPI.getListOfCategory
  );

  const brandQuery = useQuery("brand", brandAPI.getListOfBrand);

  const personTypeQuery = useQuery({
    queryKey: "person-type",
    queryFn: () => personTypeAPI.getList(),
  });

  return (
    <>
      <Head>
        <title>Product | DBRR store</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" href="/favicon.ico" />
      </Head>
      <ListProductTemplate
        listProductSortBar={<ListProductSortBar />}
        listProductSideBar={
          <ListProductSideBar
            listProductSideBarItemCategory={
              <ListProductSideBarItemCategory data={itemCategoryQuery.data} />
            }
            listProductSideBarBrand={
              <ListProductdSideBarBrand data={brandQuery.data} />
            }
            listProudctSideBarPersonType={
              <ListProductSideBarPersonType data={personTypeQuery.data} />
            }
          />
        }
        listProductProducts={<ListProductProducts data={itemQuery.data} />}
      />
    </>
  );
};

Product.getLayout = function getLayout(page: ReactElement) {
  return <HomeLayout>{page}</HomeLayout>;
};

export default Product;
