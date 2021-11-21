-- Query Brand name
select name from brand

-- Query outlet name, address, longitude, latitude
select * from outlet

-- Query total product
select count(*) as totalProduct from product

-- Query Distance Outlet position from Monas Jakarta in Kilometers and sorted by distance closest to Monas
select name,
       111.1111 *
       DEGREES(ACOS(LEAST(1.0, COS(RADIANS(latitude))
                                   * COS(RADIANS(-6.175392)) -- Latitude Monas
                                   * COS(RADIANS(longitude) - RADIANS(106.827153)) -- Longitude Monas
           + SIN(RADIANS(latitude))
                                   * SIN(RADIANS(-6.175392))))) AS distance_in_km_to_monas
FROM outlet order by distance_in_km_to_monas
