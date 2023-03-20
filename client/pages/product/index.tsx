//api
import brandAPI from "@/api/brandAPI";
import categoryAPI from "@/api/categoryAPI";
import colorAPI from "@/api/colorAPI";
import itemAPI from "@/api/itemAPI";
import itemSizeAPI from "@/api/itemSizeAPi";
import personTypeAPI from "@/api/personTypeAPI";
//component
import ListProductTemplate from "@/components/templates/product/listProduct";
import GridProducts from "@/components/templates/product/listProduct/gridProducts";
import ListProducts from "@/components/templates/product/listProduct/listProduct";
import ListProductSideBar from "@/components/templates/product/listProduct/sideBar";
import ListProductdSideBarBrand from "@/components/templates/product/listProduct/sideBar/brand";
import ListProductSideBarItemCategory from "@/components/templates/product/listProduct/sideBar/category";
import ListProductdSideBarColor from "@/components/templates/product/listProduct/sideBar/color";
import ListProductSideBarPersonType from "@/components/templates/product/listProduct/sideBar/personType";

import ListProductSideBarSize from "@/components/templates/product/listProduct/sideBar/size";
import ListProductSortBar from "@/components/templates/product/listProduct/sortBar";
import { useAppDispatch, useAppSelector } from "@/hooks/redux";
//layout
import HomeLayout from "@/layout/HomeLayout";
//nextjs
import Head from "next/head";
import React, { ReactElement, useEffect, useState } from "react";
import { useQuery } from "react-query";
import { useForm, FormProvider, SubmitHandler } from "react-hook-form";
import { yupResolver } from "@hookform/resolvers/yup";
import * as yup from "yup";
import { NextPageWithLayout } from "../_app";
import queryString from "query-string";
import { useRouter } from "next/router";
import ViewProductDialog from "@/components/templates/product/listProduct/viewProductDialog";

interface IProductParams {
  sortBy: number;
  itemPersonType: number;
  brand: number;
  category: number;
  itemColor: number[];
  itemSize: number[];
}

const createItemSizeSchema = yup.object({
  sortBy: yup.number(),
});

const Product: NextPageWithLayout = () => {
  const listProductState = useAppSelector((state) => state.ListProduct);
  const [isLoading, setIsLoading] = useState(false);

  const dispatch = useAppDispatch();

  const router = useRouter();
  const methods = useForm<IProductParams>({
    defaultValues: {
      sortBy: 1,
      itemPersonType: undefined,
      brand: undefined,
      category: undefined,
      itemColor: [],
      itemSize: [],
    },
    resolver: yupResolver(createItemSizeSchema),
  });

  const itemQuery = useQuery({
    queryKey: ["item", router.isReady, router.query],
    queryFn: () => {
      if (router.isReady) {
        const searchUrl = router.query;

        const search = {
          order_by: searchUrl.sortBy,
          item_person_type_id: searchUrl.itemPersonType,
          brand_id: searchUrl.brand,
          item_category_id: searchUrl.category,
          item_color_ids: searchUrl.itemColor,
          item_size_ids: searchUrl.itemSize,
        };
        return itemAPI.getListOfItem(search as any);
      }
      return undefined;
    },
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

  const itemColorQuery = useQuery({
    queryKey: ["item-color"],
    queryFn: () => colorAPI.getListOfColor(),
  });

  const itemSizeQuery = useQuery({
    queryKey: ["item-size"],
    queryFn: () => itemSizeAPI.getList(),
  });

  const onSubmit: SubmitHandler<IProductParams> = (data) => {};

  useEffect(() => {
    methods.watch(async (value) => {
      const stringUrl = queryString.stringify(value);
      await router.push(
        { query: queryString.parse(stringUrl) as any },
        undefined,
        {
          shallow: true,
        }
      );
    });
  }, []);

  return (
    <>
      <Head>
        <title>Product | DBRR store</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" href="/favicon.ico" />
      </Head>
      <FormProvider {...methods}>
        <form onSubmit={methods.handleSubmit(onSubmit)} id="myForm">
          <ListProductTemplate
            listProductSortBar={<ListProductSortBar />}
            listProductSideBar={
              <ListProductSideBar
                listProductSideBarItemCategory={
                  <ListProductSideBarItemCategory
                    data={itemCategoryQuery.data}
                  />
                }
                listProductSideBarBrand={
                  <ListProductdSideBarBrand data={brandQuery.data} />
                }
                listProudctSideBarPersonType={
                  <ListProductSideBarPersonType data={personTypeQuery.data} />
                }
                listProductSideBarItemColor={
                  <ListProductdSideBarColor data={itemColorQuery.data} />
                }
                listProductSideBarItemSize={
                  <ListProductSideBarSize data={itemSizeQuery.data} />
                }
              />
            }
            listProductProducts={
              listProductState.listType === "grid" ? (
                <GridProducts
                  data={itemQuery.data}
                  loading={itemQuery.isLoading}
                />
              ) : (
                <ListProducts
                  data={itemQuery.data}
                  loading={itemQuery.isLoading}
                />
              )
            }
          />
          <ViewProductDialog />
        </form>
      </FormProvider>
    </>
  );
};

Product.getLayout = function getLayout(page: ReactElement) {
  return <HomeLayout>{page}</HomeLayout>;
};

export default Product;
